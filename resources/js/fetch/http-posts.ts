import { apiAxios } from "@/fetch/axios-instance";
import { Post, ResponseData } from "@/fetch/definitions";

export type GetPostsOptions = {
    token?: string;
    userId?: string | number;
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
