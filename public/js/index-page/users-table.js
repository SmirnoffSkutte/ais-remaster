import {APP_API,APP_URL} from "../../assets/js/config.js";

function render_users(users){
    let user_table_rows=users.map((user=>{
        return `
        <tr>
            <td>
                <div class="form-check font-size-16">
                    <input type="checkbox" class="form-check-input" id="customCheck2">
                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                </div>
            </td>
            <td><a href="javascript: void(0);" class="text-body fw-bold">${user.id}</a> </td>
            <td>${user.username}</td>
            <td>
                ${user.phone}
            </td>
            <td>
                ${user.created_at}
            </td>
            <td>
                ${user.updated_at}
            </td>
        </tr>
        `
    }))

    return user_table_rows
}

function render_pagination(pagination_data){
    let pagination_links=pagination_data.links
    let backward_arrow;
    let forward_arrow;
    //Проверяем,можно ли перейти на страницу назад
    if(pagination_links[0].url !== null){
        backward_arrow=`
        <li id="pagination-backward-arrow" class="page-item">
            <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
        </li>
        `
    } else {
        backward_arrow=`
        <li id="pagination-backward-arrow" class="page-item disabled">
            <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
        </li>
        `
    }
    //Проверяем,можно ли перейти на страницу вперед
    if(pagination_links[pagination_links.length - 1].url!==null){
        forward_arrow=`
        <li id="pagination-forward-arrow" class="page-item">
            <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
        </li>
        `
    } else {
        forward_arrow=`
        <li id="pagination-forward-arrow" class="page-item disabled">
            <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
        </li>
        `
    }

    pagination_links.shift()
    pagination_links.pop()

    let pages=pagination_links.map((page)=>{
        if(page.active){
            return `
        <li class="page-item active">
            <a href="#" class="page-link page-number">${page.label}</a>
        </li>
        `
        } else {
            return `
        <li class="page-item">
            <a href="#" class="page-link page-number">${page.label}</a>
        </li>
        `
        }
    })

    // console.log(pages.join(''))
    pages.join('')

    let rendered_pages=backward_arrow+pages+forward_arrow
    document.getElementById('users-table-pagination-area').innerHTML=rendered_pages
    // bind_page_numbers()
}

function refresh_pagination(pagination_data){
    //Обновляем надпись с информацией о текущей пагинации
    document.getElementById("users-table-pagination").style.display="flex"
    document.getElementById("pagination-current-info").innerHTML=`Страница ${pagination_data.current_page} из ${pagination_data.last_page}`


    // document.querySelectorAll('.page-number').forEach()
}

function bind_page_numbers(){
    document.querySelectorAll('.page-number').forEach(page=>{
        // console.log(page)
        page.addEventListener('click',async function (event){
            let per_page=document.getElementById("table-per-page-selector").value
            let page_number_selection=event.target.innerText
            fetch(`${APP_API}/test/users_by_page?per_page=${per_page}&page=${page_number_selection}`)
                .then(res=>{
                    return res.json()
                })
                .then(new_paginated_users=>{
                    let new_rendered_user_rows=render_users(new_paginated_users.data)
                    document.getElementById("users-tbody-list").innerHTML=new_rendered_user_rows.join('')
                    refresh_pagination(new_paginated_users)
                    let new_active_page=new_paginated_users.current_page
                    document.querySelectorAll('.page-item.active').forEach(el=>{
                        el.classList.remove('active')
                    })
                    event.target.parentNode.classList.add('active')

                    if(new_active_page>1){
                        document.getElementById("pagination-backward-arrow").classList.remove('disabled')
                    } else {
                        document.getElementById("pagination-backward-arrow").classList.add('disabled')
                    }

                    if(new_active_page<new_paginated_users.last_page && new_active_page !== new_paginated_users.last_page){
                        document.getElementById("pagination-forward-arrow").classList.remove('disabled')
                    } else {
                        document.getElementById("pagination-forward-arrow").classList.add('disabled')
                    }
                    // console.log(document.querySelector('.page-item.active').childNodes[1].textContent)
                })
        })
    })

    document.getElementById("pagination-backward-arrow").addEventListener('click',async function (event){
        if(event.target.classList.contains('disabled')){
            null
        } else {
            let per_page=document.getElementById("table-per-page-selector").value
            let page_number_selection_old=document.querySelector('.page-item.active').childNodes[1].textContent
            let page_number_selection=Number(page_number_selection_old)-1
            fetch(`${APP_API}/test/users_by_page?per_page=${per_page}&page=${page_number_selection}`)
                .then(res=>{
                    return res.json()
                })
                .then(new_paginated_users=>{
                    let new_rendered_user_rows=render_users(new_paginated_users.data)
                    document.getElementById("users-tbody-list").innerHTML=new_rendered_user_rows.join('')
                    refresh_pagination(new_paginated_users)
                    let new_active_page=new_paginated_users.current_page
                    document.querySelectorAll('.page-item.active').forEach(el=>{
                        el.classList.remove('active')
                    })
                    document.querySelectorAll('.page-item').forEach(el=>{
                        if(el.childNodes[1].textContent==page_number_selection){
                            el.classList.add('active')
                        }
                    })

                    if(new_active_page>1){
                        document.getElementById("pagination-backward-arrow").classList.remove('disabled')
                    } else {
                        document.getElementById("pagination-backward-arrow").classList.add('disabled')
                    }

                    if(new_active_page<new_paginated_users.last_page && new_active_page !== new_paginated_users.last_page){
                        document.getElementById("pagination-forward-arrow").classList.remove('disabled')
                    } else {
                        document.getElementById("pagination-forward-arrow").classList.add('disabled')
                    }
                })
        }
    })

    document.getElementById("pagination-forward-arrow").addEventListener('click',async function (event){
        if(event.target.classList.contains('disabled')){
            null
        } else {
            let per_page=document.getElementById("table-per-page-selector").value
            let page_number_selection_old=document.querySelector('.page-item.active').childNodes[1].textContent
            let page_number_selection=Number(page_number_selection_old)+1
            fetch(`${APP_API}/test/users_by_page?per_page=${per_page}&page=${page_number_selection}`)
                .then(res=>{
                    return res.json()
                })
                .then(new_paginated_users=>{
                    let new_rendered_user_rows=render_users(new_paginated_users.data)
                    document.getElementById("users-tbody-list").innerHTML=new_rendered_user_rows.join('')
                    refresh_pagination(new_paginated_users)
                    let new_active_page=new_paginated_users.current_page
                    document.querySelectorAll('.page-item.active').forEach(el=>{
                        el.classList.remove('active')
                    })
                    document.querySelectorAll('.page-item').forEach(el=>{
                        if(el.childNodes[1].textContent==page_number_selection){
                            el.classList.add('active')
                        }
                    })

                    if(new_active_page>1){
                        document.getElementById("pagination-backward-arrow").classList.remove('disabled')
                    } else {
                        document.getElementById("pagination-backward-arrow").classList.add('disabled')
                    }

                    if(new_active_page<new_paginated_users.last_page && new_active_page !== new_paginated_users.last_page){
                        document.getElementById("pagination-forward-arrow").classList.remove('disabled')
                    } else {
                        document.getElementById("pagination-forward-arrow").classList.add('disabled')
                    }
                })
        }
    })
}

window.addEventListener('load', function () {
    document.getElementById("load-users-button").addEventListener("click",async function (){
        let per_page=document.getElementById("table-per-page-selector").value
        fetch(`${APP_API}/test/users_by_page?per_page=${per_page}&page_number=${1}`)
            .then(res=>{
                return res.json()
            })
            .then(paginated_users=>{
                let rendered_user_rows=render_users(paginated_users.data)
                document.getElementById("users-tbody-list").innerHTML=rendered_user_rows.join('')
                refresh_pagination(paginated_users)
                let pagination_controls=render_pagination(paginated_users)
                bind_page_numbers()
            })
    })

})

document.getElementById("table-per-page-selector").addEventListener('change',async function (){
        let per_page=document.getElementById("table-per-page-selector").value
        fetch(`${APP_API}/test/users_by_page?per_page=${per_page}&page_number=${1}`)
            .then(res=>{
                return res.json()
            })
            .then(paginated_users=>{
                let rendered_user_rows=render_users(paginated_users.data)
                document.getElementById("users-tbody-list").innerHTML=rendered_user_rows.join('')
                refresh_pagination(paginated_users)
                let pagination_controls=render_pagination(paginated_users)
                bind_page_numbers()
            })
})

