type TableHeaderType = string[];

export type ProductTableType = {
  header: TableHeaderType;
  body: {
    id: number;
    product: {
      image: string;
      name: string;
      caption: string;
    },
    category: string;
    price: string;
    inventory: 'limited' | 'in-stock' | 'out-of-stock';
  }[];
};