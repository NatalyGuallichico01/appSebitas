!function(){const e=document.querySelector("#usuarios");if(e){let t=[],n=[];const o=document.querySelector("#listadoCLientes");!async function(){const e=await fetch("/api/clientes");!function(e=[]){t=e.map(e=>({nombre:`${e.nombre.trim()} ${e.apellido.trim()}`,id:e.id})),console.log(t)}(await e.json())}(),e.addEventListener("input",(function(e){const i=e.target.value;if(console.log(i),i.length>3){const e=new RegExp(i,"i");n=t.filter(t=>{if(-1!=t.nombre.toLowerCase().search(e))return t})}else n=[];!function(){for(;o.firstChild;)o.removeChild(o.firstChild);if(n.length>0)n.forEach(e=>{const t=document.createElement("LI");t.classList.add("campo"),t.textContent=e.nombre,t.dataset.clienteId=e.id,o.appendChild(t)});else{const e=document.createElement("P");e.classList.add("listadoPonentes_no_resultados"),e.textContent="No se encontro ningun Resultado",o.appendChild(e)}}()}))}}();