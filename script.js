document.addEventListener('DOMContentLoaded', () => {
    const flower = document.getElementById('flower');
    const modal = document.getElementById('modal');
    const close = document.getElementById('close');
// bag-o
    flower.addEventListener('click', () => {
        flower.classList.toggle('glowing');
        modal.style.display = 'block';
    });

    close.addEventListener('click', () => {
        modal.style.display = 'none';
    });
// bag - o
    window.addEventListener('click', (event) => {
        if (event.target == modal) {
            flower.classList.remove('glowing');
            modal.style.display = 'none';
        }
    });

    const yesButton = document.querySelector('.yes');
    const noButton = document.querySelector('.no');

    yesButton.addEventListener('click', () => {
        alert('I love you too asawako I loveyou so much, Iloveyou very much, Iloveyou the most, Ilove you forever and ever asawako mahal na mahal kita palagi muahmuahh tsup2!');
    });

    noButton.addEventListener('click', () => {
        alert('Oh no, that’s sad!');
    });
});
