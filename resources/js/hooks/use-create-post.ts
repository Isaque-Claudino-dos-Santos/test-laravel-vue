import { createPost } from "@/fetch/http-posts";
import { useMutation } from "@tanstack/vue-query";
import useApiToken from "./use-api-token";
import { CreatePostPayload } from "@/fetch/definitions";

export default function useCreatePost() {
    const token = useApiToken();

    const { mutate } = useMutation({
        mutationKey: ["create_post"],
        mutationFn: (data: CreatePostPayload) =>
            createPost({ payload: data, token }),
    });

    return {
        mutate,
    };
}
