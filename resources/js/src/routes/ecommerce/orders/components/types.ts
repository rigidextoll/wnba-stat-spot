type TableHeaderType = string[];

export type OrderType = {
  header: TableHeaderType;
  body: {
    orderID: string;
    date: string;
    image: string;
    name: string;
    email: string;
    phone: string;
    address: string;
    paymentType: 'Credit Card' | 'Pay Pal' | 'Google Pay';
    status: 'completed' | 'processing' | 'cancel';
  }[];
};
