/**
 * @property {HTMLElement} pagination
 * @property {HTMLElement} content
 * @property {HTMLElement} sorting
 */

export default class Filter {

    /**
     *
     * @param {HTMLElement|null} element
     */
    constructor(element) {
        if(element === null){
            return
        }
        this.pagination = element.querySelector('.js-filter-pagination')
        this.content = element.querySelector('.js-filter-content')
        this.sorting = element.querySelector('.js-sorting')
        this.bindEvents()
        console.log('sa marche')
    }
    bindEvents(){
        this.sorting.querySelectorAll('a').forEach(a=>{
            a.addEventListener('click',e=> {
                e.preventDefault()
                this.loadUrl(e.target.getAttribute('href'))
            })
        })
    }
    async loadUrl(url){
        const response = await fetch(url,{
            headers: {
                'X-Requested-With' : 'XMLHttpRequest'
            }
        })
        if(response.status >=200 && response.status<300){
            const data = await response.json()
            this.content.innerHTML = data.content
            this.sorting.innerHTML = data.sorting
        }
        else {
            console.error(response)
        }
    }
}