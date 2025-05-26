type TableHeaderType = string[];

export type InventoryType = {
  header: TableHeaderType;
  body: {
    id: string,
    product: {
      name: string,
      image: string,
      addedDate: string,
    },
    condition: 'new' | 'return' | 'damaged',
    location: string,
    available: number,
    reserved: number,
    onHand: number,
    modified: string;
  }[];
};