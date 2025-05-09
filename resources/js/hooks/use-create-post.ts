import { createPost } from "@/fetch/http-posts";
import { useMutation } from "@tanstack/vue-query";
import { CreatePostPayload } from "@/fetch/definitions";
import useSession from "./use-session";
import QUERY_KEY from "@/Constants/query-key";

export type UseCreatepostOptions = {
    onSuccess: () => void;
};

export default function useCreatePost(options: UseCreatepostOptions) {
    const { apiToken: token } = useSession();

    const { mutate } = useMutation({
        mutationKey: [QUERY_KEY.CREATE_POST],
        mutationFn: (data: CreatePostPayload) =>
            createPost({ payload: data, token }),
        onSuccess: () => {
            if (options.onSuccess) options.onSuccess();
        },
    });

    return {
        mutate,
    };
}
