const tds={
  InserTD_name(tr,text){
    let td=document.createElement("td");
    let txt=document.createTextNode(text);
    td.appendChild(txt);
    tr.appendChild(td);
    return tr;
  },
  InserTD_year(tr,text){
    let td=document.createElement("td");
    let txt=document.createTextNode(text);
    td.appendChild(txt);
    tr.appendChild(td);
    return tr;
  },
  InserTD_btn(tr,id){
    let td_edit=document.createElement("td");
    let td_ex=document.createElement("td");
    let btn_edit=document.createElement("button");
    let btn_ex=document.createElement("button");
    let txt_edit=document.createTextNode("Editar");
    let txt_ex=document.createTextNode("Excluir");
    btn_edit.setAttribute("id","edit_"+id);
    btn_edit.setAttribute("class","edit");
    btn_ex.setAttribute("id","ex_"+id);
    btn_ex.setAttribute("class","ex");
    btn_edit.appendChild(txt_edit);
    btn_ex.appendChild(txt_ex);
    btn_edit.setAttribute("onclick","Getuser("+id+")");
    btn_ex.setAttribute("onclick","destroy("+id+")");
    td_edit.appendChild(btn_edit);
    td_ex.appendChild(btn_ex);
    tr.appendChild(td_edit);
    tr.appendChild(td_ex);
    return tr;
  }
}