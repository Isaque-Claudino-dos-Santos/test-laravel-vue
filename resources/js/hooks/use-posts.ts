import { useQuery } from "@tanstack/vue-query";
import { getPosts, GetPostsOptions } from "@/fetch/http-posts";
import useSession from "./use-session";
import QUERY_KEY from "@/Constants/query-key";
import { ErrorResponse } from "@/fetch/definitions";
import inf from "@/utils/inf";

export type UsePostsOptions = {
    filters: GetPostsOptions["filters"];
};

export default function usePosts(options: UsePostsOptions) {
    const { filters } = options;
    const { apiToken } = useSession();

    const { data, error, isError, isLoading } = useQuery({
        queryKey: [QUERY_KEY.GET_POSTS, filters],
        queryFn: () => getPosts({ token: apiToken, filters }),
        refetchOnWindowFocus: false,
        retry: false,
    });

    return {
        data,
        error: inf<ErrorResponse>(error),
        isLoading,
        isError,
    };
}
