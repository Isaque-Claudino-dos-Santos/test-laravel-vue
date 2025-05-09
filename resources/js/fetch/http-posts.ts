import { apiAxios } from "@/fetch/axios-instance";
import { CreatePostPayload, Post, ResponseData } from "@/fetch/definitions";
import AxiosBuilder from "@/utils/axios-builder";

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

    const params = {
        user_id: userId,
    };

    return await AxiosBuilder.build(apiAxios)
        .get("/api/posts")
        .bearer(token)
        .params(params)
        .fetch<ResponseData<Post[]>>()
        .then((response) => response.data);
}

export async function createPost(optinos: CreatePostOptions) {
    const { payload, token } = optinos;

    return await AxiosBuilder.build(apiAxios)
        .post("/api/posts")
        .bearer(token)
        .payload(payload)
        .fetch<ResponseData<Post>>()
        .then((r) => r.data);
}
