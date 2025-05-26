export type UserType = {
  name: string
  avatar: string
}

export type TodoType = {
  id: number
  taskName: string
  createDate: string
  time: string
  dueDate: string
  assigned: UserType
  status: string
  priority: string
  checked: boolean
}
