const proto = {
    parseFileExtension: (item) => {
        let ext;
        const regex = /[^.]+$/;
        const fileName = item.getAttribute('downloadhref');
        ext = fileName.match(regex)[0];
        return ext;
    },
    init () {
        const downloadList = document.querySelectorAll('.download--list');
        if (downloadList) {
            downloadList.forEach((list) => {
                const items = list.querySelectorAll('.dl--item');
                items.forEach((item) => {
                    const downloadUrl = item.querySelector('.dl-url');
                    const fileExtension = proto.parseFileExtension(downloadUrl);
                    const fileTypeEl = item.querySelector('.file-type');
                    fileTypeEl.innerHTML = fileExtension;
                });
            });
        }
    }
};

export default Object.create(proto);
