type TableHeaderType = string[]

export type SalesByCategoryTableType = {
    header: TableHeaderType
    body: {
        category: string
        orders: string
        percent: { data: number, growth: number }
    }[]
}

export type NewAccountTableType = {
    header: TableHeaderType
    body: {
        id: string
        date: string
        user: { avatar: string, name: string }
        account: 'verified' | 'pending' | 'blocked'
        username: string
    }[]
}

export type RecentTransactionsTableType = {
    header: TableHeaderType
    body: {
        id: string
        date: string
        amount: string
        status: 'cr' | 'dr'
        description: string
    }[]
}

export type RecentOrdersTableType = {
    header: TableHeaderType
    body: {
        id: string
        url?: string
        date: string
        product: { image: string }
        customer: {
            name: string
            email: string
            phoneNo: string
            address: string
            url: string
        }
        paymentType: string
        status: 'completed' | 'processing' | 'canceled'
    }[]
}