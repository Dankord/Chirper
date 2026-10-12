import { sendAction } from './sendAction'

document.querySelectorAll(".follow-form").forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const button = form.querySelector('.follow-button');
        const label = form.querySelector('.follow-label');

        try {
            button.disabled = true;

            const data = await sendAction(form);
            const isFollowing = data.following;

            // Updating label
            label.textContent = data.following
            ? 'Following'
            : 'Follow';

            button.classList.remove(
                'btn-primary',
                'btn-outline',
                'btn-ghost',
                'hover:bg-black/70',
                'hover:bg-base-200'
            );

            if (isFollowing) {
                button.classList.add('btn-ghost', 'hover:bg-base-200');
            } else {
                button.classList.add('btn-primary', 'hover:bg-black/70')
            }

            button.setAttribute('aria-pressed', String(isFollowing));

            // Update the followers count
            const count = document.querySelector('.followers-count');

            if (count) {
                count.textContent = data.followers_count;
            }
        } catch (error) {
            console.error('Failed to toggle Follow');
        } finally {
            button.disabled = false;
        }
    })
})