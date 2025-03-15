export interface Todo {
    id: number;
    name: string;
    state: TodoState;
}

    Active = 1,
    Complete = 2
}