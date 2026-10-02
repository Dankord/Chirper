import { sendAction } from './sendAction';

document.querySelectorAll('.like-form').forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        try {
            const data = await sendAction(form);

            const icon = form.querySelector('.like-icon');
            const count = form.querySelector('.like-count');

            if (data.liked) {
                icon.classList.add('fill-current', 'text-red-500');
            } else {
                icon.classList.remove('fill-current', 'text-red-500')
            }

            const textContent = data.count;
        } catch(error) {
            console.error(error);
        }
    })
})