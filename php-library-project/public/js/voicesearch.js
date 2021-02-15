const search = document.querySelector(".search");

// gọi SpeechRecognition đối tượng có sẵn của window
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

// khởi tạo đối tượng và set ngôn ngữ
const recognition = new SpeechRecognition();
recognition.lang = 'vi-VN';

// start
recognition.onstart = function(){
    console.log("Đã mở microphone");

    document.getElementById("voice").style.display = "block";
};

// stop
recognition.onend = function(){
    console.log("Đã tắt microphone");

    document.getElementById("voice").style.display = "none";
}

// kết quả
recognition.onresult = function(event){
	// console.log(event);

	const current = event.resultIndex;
	const transcript = event.results[current][0].transcript;
    search.value = transcript;
};

// bật mic
search.addEventListener("click", ()=>{
    recognition.start();
});