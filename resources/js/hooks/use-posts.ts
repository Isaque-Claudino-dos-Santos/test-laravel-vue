import { useQuery } from "@tanstack/vue-query";
import { getPosts } from "@/fetch/http-posts";
import useSession from "./use-session";
import QUERY_KEY from "@/Constants/query-key";

export default function usePosts() {
    const { apiToken: token, user } = useSession();
    const userId = user.id;

    const { data, isLoading } = useQuery({
        queryKey: [QUERY_KEY.GET_POSTS, userId],
        queryFn: () => getPosts({ token, userId }),
        refetchOnWindowFocus: false,
        retry: false,
    });

    return {
        data,
        isLoading,
    };
}
