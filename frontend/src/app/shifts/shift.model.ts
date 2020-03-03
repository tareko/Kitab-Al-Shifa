export interface Shift {
  _id: string;
  user_id: number;
  date: string;
  shifts_type_id: number;
  marketplace?: boolean;
  updated?: string;
}
