export default class HttpRequestMethod {
    static async delete(url, csrfToken) {

        const response = await fetch(
            url,
            {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            }
        )

        return await response.json();
    }

    static async put(url, data, csrfToken) {

        data.append('_method', 'PUT')
        const response = await fetch(
            url,
            {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: data
            }
        )

        return await response.json();
    }
}
