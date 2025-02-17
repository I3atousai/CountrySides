
// function delete_link(id, short_link) {
//     const formData = new FormData()
//     formData.append('id', id)
//     formData.append('short_link', short_link)
//     $.ajax({
//         url: `${BASE_URL}/middleware/links/delete.php`,
//         method: "post",
//         processData: false,
//         contentType: false,
//         data: formData,
//         dataType: "json"
//     })
//     document.getElementById(id).classList.add('hidden')
// }

const avatar_input = document.getElementById('avatar_input')

avatar_input.onchange = change_avatar

function change_avatar() {
    let file = avatar_input.files[0]
    let path = "users"
    let img = avatar_input.nextElementSibling;
    download_file(file, path)
        .then(data => {
            img.src = data.url
        })
        .catch(err => console.log(err))
}

const formDataChange = new FormData()

function save_changes(element_id, sql_column) {
    let change = document.getElementById(element_id).value
    formDataChange.append(sql_column, change)
    console.log(sql_column);
}

const submit_changes = document.getElementById('submit_change')
const initiaie_change = document.getElementById('initiate_change')

let disp = document.getElementById('displayed')
let chng_form = document.getElementById('change_form')

submit_changes.onclick = push_cahnges
initiaie_change.onclick = toggle_display

function push_cahnges() {
    $.ajax({
        url: `${BASE_URL}/middleware/users/update_usr_page.php`,
        method: "post",
        processData: false,
        contentType: false,
        data: formDataChange,
        dataType: "json"
    })
    chng_form.style.display = 'none';
    disp.style.display === 'block'
}

function toggle_display() {
    disp.style.display = 'none';
    chng_form.style.display = 'block';
}



let portion = 1;

const lenta_load = document.querySelector(".tour_load")

function get_tours_portion() {
    $.ajax({
        url: `${BASE_URL}/middleware/users/tours/tours_visited.php?portion=${portion}`,
        method: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data)
            if (data.tours && data.tours.length > 0) {
                print_tours_lenta(data.tours)
            }
            if (!data.is_next ) {
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

                
                if ( typeof(tour.fav) === "undefined") {
                    shablon +=  `<button id="fav_${tour.id}" class="fav" onclick="fav(${tour.id})">💗</button>`
                } else {
                    shablon +=  `<button id="fav_${tour.id}" onclick="fav(${tour.id})" class='fav faved'>💗</button>`
                }
        
                shablon +=  `<p class="tour_price">${tour.price} руб.</p>
                </div>
                </div>
                `
        lenta.insertAdjacentHTML("afterbegin", shablon);
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


