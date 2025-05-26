<script lang="ts">
    import Dropzone from "dropzone";
    import {Button} from "@sveltestrap/sveltestrap";
    import {onMount} from "svelte";

    onMount(() => {
        const dropzonePreviewNode = document.querySelector("#dropzone-preview-list") as HTMLElement;
        dropzonePreviewNode.id = "";
        if (dropzonePreviewNode) {
            const previewTemplate = dropzonePreviewNode.parentElement?.innerHTML;
            dropzonePreviewNode.parentNode?.removeChild(dropzonePreviewNode);
            const dropzone = new Dropzone(".dropzone", {
                url: 'https://httpbin.org/post',
                method: "post",
                previewTemplate: previewTemplate,
                previewsContainer: "#dropzone-preview",
            });
        }
    })
</script>

<h5 class="fs-14 mb-1">
    Product Gallery
</h5>
<p class="text-muted fs-13">
    Add Product Gallery Images.
</p>
<form action="/" method="post" class="dropzone" id="productImagesForm" data-plugin="dropzone"
      data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
    <div class="fallback">
        <input name="file" type="file" multiple/>
    </div>

    <div class="dz-message needsclick">
        <i class="h1 bx bx-cloud-upload"></i>
        <h3>
            Drop files here or click to upload.
        </h3>
        <span class="text-muted fs-13">
        (This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)
      </span>
    </div>
</form>
<ul class="list-unstyled mb-0" id="dropzone-preview">
    <li class="mt-2" id="dropzone-preview-list">
        <!-- This is used as the file preview template -->
        <div class="border rounded">
            <div class="d-flex align-items-center p-2">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar-sm bg-light rounded">
                        <img data-dz-thumbnail class="img-fluid rounded d-block" src="#" alt="Dropzone-Img"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="pt-1">
                        <h5 class="fs-14 mb-1" data-dz-name>
                            &nbsp;
                        </h5>
                        <p class="fs-13 text-muted mb-0" data-dz-size></p>
                        <strong class="error text-danger" data-dz-errormessage></strong>
                    </div>
                </div>
                <div class="flex-shrink-0 ms-3">
                    <Button color="danger" size="sm" data-dz-remove>
                        Delete
                    </Button>
                </div>
            </div>
        </div>
    </li>
</ul>