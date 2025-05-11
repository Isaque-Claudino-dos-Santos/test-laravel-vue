import { apiAxios } from "@/fetch/axios-instance";
import {
    CreatePostPayload,
    PaginationResponse,
    Post,
    ResponseData,
} from "@/fetch/definitions";
import AxiosBuilder from "@/utils/axios-builder";

export type GetPostsOptions = {
    token?: string;
    filters: {
        page?: number;
        userId?: number;
        limit?: number;
    };
};

export type CreatePostOptions = {
    payload: CreatePostPayload;
    token?: string;
};

export async function getPosts(optinos: GetPostsOptions) {
    const { token, filters } = optinos;

    const params = {
        user_id: filters.userId,
        limit: filters.limit,
        page: filters.page,
    };

    return AxiosBuilder.build(apiAxios)
        .get("/api/posts")
        .bearer(token)
        .params(params)
        .fetch<PaginationResponse<Post>>();
}

export async function createPost(optinos: CreatePostOptions) {
    const { payload, token } = optinos;

    return await AxiosBuilder.build(apiAxios)
        .post("/api/posts")
        .bearer(token)
        .payload(payload)
        .fetch<ResponseData<Post>>();
}
