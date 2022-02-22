(function(){
    console.log('js app.js rodou');
    const $selectArea = document.querySelector('.selectArea');
    const $selectSubArea = document.querySelector('.selectSubArea');

    const url = new URL(window.location.href);
    const path = url.pathname;
    const search = url.search;

    if($selectArea){
        $selectArea.addEventListener('click', (event) =>{
            console.log('entrou no do selectArea');
            let option = $selectArea.querySelectorAll('option');
            let count = option.length;
            if(typeof count === 'undefined' || count < 2 || event.target.value === ''){
                console.log('tem menos de 2 ou nada');
            }
        });
    
        $selectArea.addEventListener('change', (event) => {
            console.log('entrou no selectArea listener');
            let option = '';
            if(search !== ''){
                option = `&option=${event.target.value}`;
            }
            else{
                option = `?option=${event.target.value}`;
            }

            if(event.target.value !== ''){
                // window.location.href = "createRevise.php?option=" + event.target.value;
                window.location.href = path + search + option;
                // console.log(path + search + option);
            }
        });
    }

    if($selectSubArea){
        $selectSubArea.addEventListener('click', (event) => {
            // console.log('entrou no click');
            let option = $selectSubArea.querySelector('option');
            let count = option.length;
            if(typeof count === 'undefined' || count < 2 || event.target.value === ''){
                console.log('tem menos de 2 ou nada');
            }
        });

        $selectSubArea.addEventListener('change', (event) => {
            let selectedSubarea = `&subarea=${event.target.value}`;
            let assuntoId = new URLSearchParams(search).get('id');
            if(assuntoId){
                window.location.href = path + `?id=${assuntoId}` + selectedSubarea;
            }
        });
    }
})();