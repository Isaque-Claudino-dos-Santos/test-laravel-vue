import { apiAxios } from "@/fetch/axios-instance";
import { CreatePostPayload, Post, ResponseData } from "@/fetch/definitions";

export type GetPostsOptions = {
    token?: string;
    userId?: string | number;
};

export type CreatePostOptions = {
    payload: CreatePostPayload;
    token?: string;
};

export async function getPosts(optinos: GetPostsOptions) {
    const { token, userId } = optinos;

    return await apiAxios
        .get<ResponseData<Post[]>>("/api/posts", {
            headers: {
                Authorization: `Bearer ${token}`,
            },
            params: {
                user_id: userId,
            },
        })
        .then((r) => r.data.data);
}

export async function createPost(optinos: CreatePostOptions) {
    const { payload, token } = optinos;

    console.log(token);

    return await apiAxios
        .post<ResponseData<Post>>("/api/posts", payload, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        })
        .then((r) => r.data.data);
}
