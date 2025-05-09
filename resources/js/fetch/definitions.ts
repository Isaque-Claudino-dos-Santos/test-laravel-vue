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
};

export type ErrorResponse = {
    title: string | null;
    description: string | null;
    statusCode: number;
    errorCode: string | null;
    fields: Record<string, string[]> | null;
    instance: string | null;
    timestamp: string;
};
