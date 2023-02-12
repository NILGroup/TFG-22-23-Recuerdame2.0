function setValue() {
    const
        newValue = Number((range.value - range.min) * 100 / (range.max - range.min)),
        newPosition = 10 - (newValue * 0.2);
    rangeV.innerHTML = `<span>${range.value}</span>`;
    rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
};
const
    range = document.getElementById('puntuacion'),
    rangeV = document.getElementById('rangeV');
document.addEventListener("DOMContentLoaded", setValue);
range.addEventListener('input', setValue);