

async function download_file(file, path) {
    const formData = new FormData()
    formData.append("path", path)
    formData.append('file', file)
    return $.ajax({
        url: `${BASE_URL}/middleware/public/download_file.php`,
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json"
    })
}



