type TableHeaderType = string[]

export type TransactionsTableType = {
    header: TableHeaderType
    body: {
        user: { name: string, avatar: string },
        description: string
        amount: number
        timestamp: string
        status: 'success' | 'cancelled' | 'on-hold' | 'failed'
    }[]
}

export type RevenueSourceTableType = {
    header: TableHeaderType
    body: {
        source: string
        revenue: string
        percent: { data: number, growth: number }
    }[]
}