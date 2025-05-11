export type ResponseData<T> = {
    data: T;
};

export type Post = {
    id: number;
    title: string;
    content: string;
    created_at: string;
};

export type CreatePostPayload = {
    title: string;
    content: string;
    user_id: number;
};

export type ErrorResponse = {
    title: string | null;
    description: string | null;
    status_code: number;
    error_code: string | null;
    fields: Record<string, string[]> | null;
    instance: string | null;
    timestamp: string;
};

export type PaginationResponse<T> = {
    next_page?: number;
    prev_page?: number;
    per_pages: number;
    total_data: number;
    total_pages: number;
    current_page: number;
    data: T[];
};
