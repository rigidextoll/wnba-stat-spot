export type ButtonType = {
  text: string
  disabled: boolean
}
export type PlanType = {
  name: string
  price: number
  period: string
  ribbon?: string
  features: string[]
  button: ButtonType
}
