import { ref } from "vue";
import { useToast } from "vue-toast-notification";
import useCreatePost from "./use-create-post";
import { z } from "zod";
import { useForm } from "@inertiajs/vue3";

export default function useCreatePostForm() {
    const errors = ref({});
    const toast = useToast();

    const { mutate } = useCreatePost({
        onSuccess: () => {
            location.href = route("posts.index");
            toast.success("Post created successfuly");
        },
    });

    const schema = z.object({
        title: z.string().min(1, "title is required"),
        content: z.string().min(1, "content is required"),
        userId: z
            .string()
            .min(1, "user to send is required")
            .transform((value) => Number(value)),
    });

    const form = useForm({
        title: "",
        content: "",
        userId: "",
    });

    const onSubmit = () => {
        const schemaParse = schema.safeParse(form);
        const formValidated = schemaParse.data;

        errors.value = {};

        if (!schemaParse.success) {
            errors.value = schemaParse.error.flatten().fieldErrors;
            return;
        }

        mutate({
            title: formValidated.title,
            content: formValidated.content,
            user_id: formValidated.userId,
        });
    };

    return {
        onSubmit,
        form,
        errors,
    };
}
