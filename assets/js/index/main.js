let portion = 1;

const lenta_load = document.querySelector(".tour_load")

function get_tours_portion() {
    $.ajax({
        url: `${BASE_URL}/middleware/users/tours/get_tours_lenta.php?portion=${portion}`,
        method: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data)
            if (data.tours && data.tours.length > 0) {
                print_tours_lenta(data.tours)
            }
            if (!data.is_next) {
                lenta_load.remove()
            }
        },
        error: function (err) {
            console.log(err)
        }
    })
}

const lenta = document.querySelector('.lenta')
function print_tours_lenta(tours) {
    tours.forEach(tour => {
        let shablon =
            `
        <div class="tour mb24">
            <div id="tour_${tour.id}" class="tour_photos">
        `;
        tour.images.forEach(image => {
            shablon +=
                `
            <div class="tour_photo">
                <img src="${BASE_URL}/assets/image/tours/${image.image}" alt="">
            </div>
            `
        });
        shablon +=
            `
                </div>
                <div class="tour_content">
                    <h3>${tour.title}</h3>
                    <p>${tour.content}</p>
                </div>
                <div class="tour_management">`

                if (typeof tour.fav === 'undefined') {
                  shablon +=  `<button id="fav_${tour.id}" class="fav" onclick="fav(${tour.id})">💗</button>`
                } else  {
                    shablon +=  `<button id="fav_${tour.id}" onclick="fav(${tour.id})" class='fav faved'>💗</button>`
                }
        
                shablon +=  `<p class="tour_price">${tour.price} руб.</p>
                </div>
                </div>
                `
        lenta.insertAdjacentHTML("beforeend", shablon);
        set_slider(document.getElementById(`tour_${tour.id}`))
    });
}



function fav(id) {
    const formData = new FormData()
    formData.append('id_tour', id)
    formData.append('id_user', id_user)
    $.ajax({
        url: `${BASE_URL}/middleware/users/tours/favorite_tour.php`,
        method: "post",
        processData: false,
        contentType: false,
        data: formData,
        dataType: "json"
    })
    
    document.getElementById(`fav_${id}`).classList.toggle('faved')
}

get_tours_portion();

lenta_load.onclick = function () {
    portion++;
    get_tours_portion()
}


