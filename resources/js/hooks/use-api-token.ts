import { usePage } from "@inertiajs/vue3";

export default function useApiToken(): string {
    const page = usePage();
    const token = page.props.apiAcesseToken as string;

    return token;
}
