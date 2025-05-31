var clipboard = new ClipboardJS('#copyButton, #cutButton');

clipboard.on('success', function (e) {
    // Handle success, e.text is the copied text
    // alert('Copied text: ' + e.text);
    Toastify({
        text: "คัดลอกข้อความเรียบร้อย",
        duration: 3000,
        newWindow: true,
        close: false,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        style: {
            background: "#0000FF",
        },
        onClick: function(){}
        }).showToast(); 	
});

clipboard.on('error', function (e) {
    // Handle error
    alert('Copy/Cut failed');
});