export default function inf<T extends unknown>(data: unknown): T {
    return data as T;
}
