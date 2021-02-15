// cái này áp dụng cho tất cả
const sr = ScrollReveal({
     // bắt đầu animation từ đâu
     origin: 'bottom',
     // cách bao nhiêu px từ vị trí bắt đầu
     distance: '50px',
     // tỉ lệ - xem demo
     scale: 0.5,
     // áp dụng cho mobile không
     mobile: true,
     // có áp dụng hiệu ứng khi scroll lên xuống lại không
     reset: true,
     // trong thời gian bao lâu
     duration: 1000
});

// const sr = ScrollReveal();

sr.reveal('.card',{
},50);

sr.reveal('.scroll',{
},50);