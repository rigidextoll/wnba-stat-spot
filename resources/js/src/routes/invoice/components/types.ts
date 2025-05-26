export type ClientType = {
  name: string
  avatar: string
}

export type InvoiceType = {
  invoiceNumber: string
  client: ClientType
  issueDate: string
  dueDate: string
  amount: number
  status: 'send' | 'unpaid' | 'paid'
  paymentMethod: string
}

export type ProductType = {
  name: string
  qty: number
  price: number
}

export type InvoiceDetailType = {
  invoiceNo: string
  customerName: string
  street: string
  location: string
  contact: string
  products: ProductType[]
}
