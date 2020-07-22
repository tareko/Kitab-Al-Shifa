export interface User {
  user_id: number;
  name: string;
  email: string;
  telephone: number;
  pager: number;
  observe?: "any";
}

export declare type Users = User[];
