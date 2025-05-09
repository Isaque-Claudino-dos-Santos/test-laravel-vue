import { useQuery } from "@tanstack/vue-query";
import { getPosts } from "@/fetch/http-posts";
import useApiToken from "./use-api-token";
import { usePage } from "@inertiajs/vue3";

export default function usePosts() {
    const page = usePage();
    const token = useApiToken();
    const { data, error, isLoading } = useQuery({
        queryKey: ["posts", token, page.props.auth.user.id],
        queryFn: () => getPosts({ token, userId: page.props.auth.user.id }),
    });

    return {
        data,
        error,
        isLoading,
    };
}
