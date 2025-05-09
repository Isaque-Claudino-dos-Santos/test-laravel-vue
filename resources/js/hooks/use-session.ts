import { usePage } from "@inertiajs/vue3";

export default function useSession() {
    const page = usePage();
    const apiToken = page.props.apiToken as string;

    return {
        user: page.props.auth.user,
        apiToken,
    };
}
