const noteSelect= document.querySelector('#notes');
noteSelect.addEventListener('change', (event)=>{
    resetNote();
    changeNote(event.target.value);
})

let notes=[];
for (let i=0; i<5; ++i){
    let n= '#note'+(i+1);
    let note= document.querySelector(n);
    notes.push(note);
}

function resetNote(){
    for (let i=0; i<5; ++i){
        if (notes[i].classList.contains('text-warning')){
            notes[i].classList.remove('text-warning');
            notes[i].classList.add('text-secondary');
        }
    }
}

function changeNote(note){
    note= parseInt(note);
        for (let i=0; i<5; ++i){
            if (notes[i].classList.contains('text-secondary')){
                if (note!==i){
                    notes[i].classList.remove('text-secondary');
                    notes[i].classList.add('text-warning');
                } else {
                    break;
                }
            }
        }
}