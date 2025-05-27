#!/bin/bash

echo "🧪 Testing WNBA Stat Spot Deployment Locally"
echo "=============================================="

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker is not running. Please start Docker first."
    exit 1
fi

echo "✅ Docker is running"

# Build the Docker image
echo "🔨 Building Docker image..."
docker build -t wnba-stat-spot-test . || {
    echo "❌ Docker build failed"
    exit 1
}

echo "✅ Docker image built successfully"

# Run the container with test environment
echo "🚀 Starting container..."
docker run -d \
    --name wnba-test \
    -p 8080:80 \
    -e APP_ENV=local \
    -e APP_DEBUG=true \
    -e APP_KEY=base64:test-key-for-local-testing \
    -e DB_CONNECTION=sqlite \
    -e DB_DATABASE=/tmp/database.sqlite \
    -e CACHE_DRIVER=array \
    -e QUEUE_CONNECTION=sync \
    -e SESSION_DRIVER=array \
    wnba-stat-spot-test || {
    echo "❌ Failed to start container"
    exit 1
}

echo "✅ Container started"

# Wait for application to start
echo "⏳ Waiting for application to start..."
sleep 10

# Test health endpoint
echo "🔍 Testing health endpoint..."
if curl -f http://localhost:8080/health > /dev/null 2>&1; then
    echo "✅ Health endpoint is working"
    echo "📊 Health response:"
    curl -s http://localhost:8080/health | jq . || curl -s http://localhost:8080/health
else
    echo "❌ Health endpoint failed"
    echo "📋 Container logs:"
    docker logs wnba-test
fi

# Test main application
echo "🔍 Testing main application..."
if curl -f http://localhost:8080/ > /dev/null 2>&1; then
    echo "✅ Main application is responding"
else
    echo "❌ Main application failed"
    echo "📋 Container logs:"
    docker logs wnba-test
fi

# Show container status
echo "📊 Container status:"
docker ps | grep wnba-test

echo ""
echo "🌐 Application is running at: http://localhost:8080"
echo "🏥 Health check: http://localhost:8080/health"
echo ""
echo "To stop the test:"
echo "  docker stop wnba-test && docker rm wnba-test"
echo ""
echo "To view logs:"
echo "  docker logs wnba-test"
