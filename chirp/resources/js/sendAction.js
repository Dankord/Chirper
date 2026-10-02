export async function sendAction(form) {
    const response = await fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
            'Accept': 'application/json'
        },
    });

    if (!response.ok) {
        throw new Error("Action failed");
    }

    return await response.json();
}