
@extends('auth')

@section('pageStyle')

    <style>
        .btn{
            white-space: nowrap;
        }
        td > img{
            height: 35px;
            cursor: pointer;
        }
        .image-upload-container input{
            display: none;
        }
        .image-upload-container img{
            height: 100px;
            border-radius: 5px;
        }
    </style>

@stop

@section('pageContent')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card rounded">
                    <div class="card-body" id="page-content">

                    </div>
                </div>

            </div>
        </div>
    </div>
    
@stop

@section('pageScript')

    <script>

        class Table{
            #name; #tablename; #actions; #listFields; #addFields; #editFields; #extraActions; #url; #limit; #from = 0; #id; #data = []; #extraFilter; #imageFolder = ""; #relations = {like: null}; #fieldDetails; #filter = {};

            constructor(name, tablename, actions, listFields, addFields, editFields, url, fieldDetails, imageFolder, extraActions = null, extraFilter = null, limit = 10){

                this.#name          = name;
                this.#tablename     = tablename;
                this.#actions       = actions;
                this.#listFields    = listFields;
                this.#addFields     = addFields;
                this.#editFields    = editFields;
                this.#url           = url;
                this.#fieldDetails  = fieldDetails;
                this.#imageFolder   = imageFolder;
                this.#extraActions  = extraActions;
                this.#limit         = limit;
                this.#extraFilter   = extraFilter;
                this.#id            = name + '-' + (new Date()).getTime();
                
                this.#setupTable();
                
            }

            #setupTable = () => {
                const $this = this;
                if(this.#actions.edit)
                    $(document).on('click',`#${this.#id} .edit-action`,function(e){ $this.#edit($(this).data('id')); });
                    
                if(this.#actions.delete)
                    $(document).on('click',`#${this.#id} .delete-action`,this.#delete);
                    
                if(this.#actions.add){
                    $(document).on('click',`#${this.#id} .add-action`,this.#add);
                    $(document).on('submit',`#${this.#id}`,this.#save);
                }

                if(this.#extraFilter){
                    $this.#extraFilter.forEach(filter => $this.#filter[filter] = null);
                    $(document).on('change','.extraFilter',function(e){
                        const value = $(this).val();
                        const field = $(this).data('field');
                        if(!value) $this.#filter[field] = null;
                        else $this.#filter[field] = value;
                        $this.#showTable();
                    });
                }

                $(document).on('click',`#${this.#id} .list-action`,() => this.#list());

                this.#list();
            };

            #displayContent = pageContent => {
                $(document).find("#page-content").html(pageContent);
                $(document).find('.select2').select2();
            };

            #edit = id => {
                const data = this.getData(id);
                if(data === null) return;
                let inputs = ``;
                this.#editFields.forEach(field => inputs += this.getField(field,data));
                const pageContent = `
                    <form class="row" id="${this.#id}" data-type="edit" novalidate>
                        <input type="hidden" name="id" value="${id}"/>
                        <input type="hidden" name="_method" value="put"/>
                        ${inputs}
                        <div class="col-md-12 text-center">
                            <button class="btn btn-success btn-sm rounded">Save</button>
                            <button class="btn btn-danger btn-sm rounded list-action" type="button">Cancel</button>
                        </div>
                    </form>
                `;
                this.#displayContent(pageContent);
            };
            #delete = e => {
                const id = $(e.target).data('id');

                swal(
                    {
                        title: "Are you sure?",
                        text: "You will not be able to recover this data!",
                        type: "warning",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        showLoaderOnConfirm: true
                    },
                    () => $.ajax({
                        type: 'DELETE',
                        url: this.#url + '/' + id,
                        dataType: 'json',
                        cache : false,
                        processData: false,
                        success: (response, status, xhr) => {
                            this.#list(
                                () => swal({
                                    title: response.text,
                                    text: "",
                                    type:  response.success ? "success" : "error",   
                                })
                            );
                        }
                    })
                );

            };
            #add = e => {
                let inputs = ``;
                this.#addFields.forEach(field => inputs += this.getField(field));
                const pageContent = `
                    <form class="row" id="${this.#id}" data-type="add" novalidate>
                        ${inputs}
                        <div class="col-md-12 text-center">
                            <button class="btn btn-success btn-sm rounded">Save</button>
                            <button class="btn btn-danger btn-sm rounded list-action" type="button">Cancel</button>
                        </div>
                    </form>
                `;
                this.#displayContent(pageContent);
            };
            #save = e => {
                e.preventDefault();

                let form = document.getElementById(this.#id);
                
                let formdata = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: this.#url,
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: (response, status, xhr) => {
                        swal({
                            title: response.text,
                            text: "",
                            type:  response.success ? "success" : "error",   
                        });
                        if(response.success)
                            this.#list();
                    }
                });
            };

            getField = (field,data = {}) => {
                const fieldDetail = this.#fieldDetails[field];
                const jsonValue = this.#fieldDetails[field].multiple ? (data[field] ? JSON.parse(data[field]) : []) : (data[field] ? [data[field]] : []);
                let input = ``;
                if(fieldDetail.type === "select")
                    input = `
                        <select
                            name="${fieldDetail.name}"
                            id="${fieldDetail.name}"
                            ${fieldDetail.required ? 'required' : ''}
                            class="form-control select2"
                            validate
                            ${fieldDetail.required ? 'required' : ''}
                            ${fieldDetail.multiple ? 'multiple' : ''}
                        >
                            <option value="">Select option</option>
                            ${
                                fieldDetail.options ?
                                fieldDetail.options.map(option =>
                                    `<option
                                        value="${option.id}"
                                        ${data && data[field] === option.id ? 'selected' : '' }
                                    >${option.value}</option>`
                                ) : (
                                    fieldDetail.relation && this.#relations[fieldDetail.relation] ?
                                    this.#relations[fieldDetail.relation].map(option => 
                                        `<option
                                        value="${option.id}"
                                        ${jsonValue.includes(option.id) ? 'selected' : '' }
                                    >${option.value}</option>`
                                    ) : ''
                                )
                            }
                        </select>
                    `;
                else if(fieldDetail.type === "image")
                    input = `
                        <div class="image-upload-container">
                            <input
                                type="file"
                                name="${fieldDetail.name}"
                                id="${fieldDetail.name}"
                            />
                            <img src="${data && data[field] ? '{{ asset('') }}' + fieldDetail.path + data[field] : '{!! asset('images/placeholder.png') !!}'}" data-image="${data && data[field] ? '{{ asset('') }}' + fieldDetail.path + data[field] : '{!! asset('images/placeholder.png') !!}'}"/>
                        </div>
                    `;
                else
                    input = `
                        <input
                            type="${fieldDetail.type}"
                            name="${fieldDetail.name}"
                            id="${fieldDetail.name}"
                            placeholder="${fieldDetail.placeholder ? fieldDetail.placeholder : ''}"
                            class="form-control"
                            validate
                            ${fieldDetail.required ? 'required' : ''}
                            ${fieldDetail.pattern ? `pattern="${fieldDetail.pattern}"` : ''}
                            value="${fieldDetail.value ? `${fieldDetail.value}` : (data && data[field] ? data[field] : '')}"
                        />
                    `;
                if(fieldDetail.type !== "hidden")
                    input = `
                        <div class="col-md-12">
                            <div class="form-group">
                                <lable for="${fieldDetail.name}">${fieldDetail.label ? fieldDetail.label : fieldDetail.name.replace('_',' ')}${fieldDetail.required ? '*' : ''}</lable>
                                ${input}
                            </div>
                        </div>
                    `;
                return input;
            };

            #showTable = () => {

                let fields = 1;
                let header = `<th>#</th>`;
                this.#listFields.forEach(value => {
                    header += `<th>${ this.#fieldDetails[value].label ? this.#fieldDetails[value].label : value.replace('_',' ')}</th>`;
                    fields++;
                })
                if(this.#actions.delete || this.#actions.edit || this.#extraActions){
                    header += `<th>Action</th>`;
                    fields++;
                }

                let body = ``;
                let counter = 0;
                if(this.#data.length !== 0){

                    for(let index = this.#from; index < this.#data.length && counter < this.#limit; index++){
                        const value = this.#data[index];

                        const extraFilters = this.#extraFilter ? this.#extraFilter : [];
                        let filterPass = true;
                        for(let m = 0; m < extraFilters.length; m++){
                            if(this.#filter[extraFilters[m].field] && this.#filter[extraFilters[m].field] != value[extraFilters[m].field]){
                                filterPass = false;
                                break;
                            }
                        }
                        if(!filterPass) continue;

                        let row = `<td>${++counter}</td>`;
                        this.#listFields.forEach(field =>  {
                            if(this.#fieldDetails[field].type === 'select'){
                                let columnValue = "";
                                const options = this.#fieldDetails[field].relation ? this.#relations[this.#fieldDetails[field].relation] : this.#fieldDetails[field].options;
                                if(this.#fieldDetails[field].multiple){
                                    const jsonValues = JSON.parse(value[field]);
                                    for(let x = 0; options && x < options.length; x++){
                                        if(jsonValues.includes(options[x].id)){
                                            if(columnValue != "") columnValue += ", ";
                                            columnValue += options[x].value;
                                        }
                                    }
                                }else{
                                    for(let x = 0; options && x < options.length; x++){
                                        if(options[x].id === value[field]){
                                            columnValue = options[x].value;
                                            break;
                                        }
                                    }
                                }
                                row += `<td>${columnValue}</td>`;
                            }
                            else if(this.#fieldDetails[field].type === 'image'){
                                row += `<td align="center">${value[field] ? `<img class="rounded" src="${this.#imageFolder + value[field]}"/>` : ''}</td>`;
                            }
                            else
                                row += `<td>${value[field] ? value[field] : ''}</td>`;
                        });

                        let buttons = ``;
                        if(this.#actions.edit)
                            buttons += `<button class="btn btn-warning btn-sm edit-action mr-2 rounded" data-id="${value.id}">
                                <i class="mr-1 mdi mdi-pencil-box"></i> Edit
                            </button>`;

                        if(this.#actions.delete)
                            buttons += `<button class="btn btn-danger btn-sm delete-action mr-2 rounded" data-id="${value.id}">
                                <i class="mr-1 mdi mdi-delete-forever"></i> Delete
                            </button>`;
                        if(this.#extraActions){
                            this.#extraActions.forEach(action => {
                                let link = action.link;
                                for(const [repKey, repValue] of Object.entries(action.replace)){
                                    link = link.replace(repKey, value[repValue]);
                                }
                                buttons += `<a class="btn ${action.class} btn-sm mr-2 rounded" href="${link}">
                                    <i class="${action.icon} mr-1"></i> ${action.name}
                                </a>`;
                            });
                        }
                        if(buttons !== "")
                            buttons = `<td><div class="d-flex">${buttons}</div></td>`;
                        
                        body += `<tr>
                            ${row}
                            ${buttons}
                        </tr>`;
                    }
                }
                if(counter === 0)
                    body = `<tr>
                        <td colspan="${fields}">No records found</td>
                    </tr>`;

                const pageContent = `<div class="table-responsive" id="${this.#id}">
                    <div class="row mb-2 mx-0">
                        <div class="col-md-6 d-flex p-0">
                            <div class="mr-2 form-group mb-0">
                                <select class="form-control" id="limit-set">
                                    ${ [10,25,50,100].map(v => `<option value="${v}" ${v === this.#limit ? 'selected' : ''}>${v}</option>`) }
                                </select>
                            </div>
                            ${this.#actions.add ? `
                                <button class="btn btn-success btn-sm rounded add-action">
                                    <i class="mr-1 mdi mdi-plus"></i> Add
                                </button>
                            ` : ''}
                        </div>
                        <div class="col-md-6 p-0">
                            <div class="d-flex justify-content-end">
                                ${ this.#getExtraFilters() }
                                <div class="ml-2 form-group mb-0">
                                    <input type="text" class="form-control" placeholder="Search..." id="search-box"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                ${header}
                            </tr>
                        </thead>
                        <tbody>
                            ${body}
                        </tbody>
                    </table>
                    <div class="d-flex">
                        ${this.getPagination(this.#data.length,this.#limit,this.#from)}
                    </div>
                </div>`;
                this.#displayContent(pageContent);
            };

            #getExtraFilters = () => {
                let filterHtml = '';
                if(this.#extraFilter)
                    this.#extraFilter.forEach(filter => {
                        const fieldDetail = this.#fieldDetails[filter.field];
                        filterHtml = `<div class="ml-2 form-group mb-0">
                            <select class="select2 form-control extraFilter" id="${fieldDetail.name + '-' + this.#id}" data-field="${fieldDetail.name}">
                                ${ filter.all ? `<option value="">All ${fieldDetail.label}</option>` : '' }
                                ${
                                    fieldDetail.options ?
                                    fieldDetail.options.map(option =>
                                        `<option
                                            value="${option.id}"
                                            ${ this.#filter[fieldDetail.name] == option.id ? 'selected' : '' }
                                        >${option.value}</option>`
                                    ) : (
                                        fieldDetail.relation && this.#relations[fieldDetail.relation] ?
                                        this.#relations[fieldDetail.relation].map(option => 
                                            `<option
                                                value="${option.id}"
                                                ${ this.#filter[fieldDetail.name] == option.id ? 'selected' : '' }
                                            >${option.value}</option>`
                                        ) : ''
                                    )
                                }
                            </select>
                        </div>`;
                    });
                return filterHtml;
            };
            
            getPagination = (len,limit,active) => {
                let pages = ``;
                let f = 0;
                let i = 1;
                while(f < len){
                    pages += `
                        <li class="page-item active">
                            <span class="page-link" data-from="${f}">${i++}</span>
                        </li>
                    `;
                    f += limit;
                }

                return `
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item ${active === 0 ? 'disabled' : ''}">
                                <span class="page-link"><i class="mdi mdi-chevron-double-left"></i></span>
                            </li>
                            ${ pages }
                            <li class="page-item ${len <= limit + active ? 'disabled' : ''}">
                                <span class="page-link"><i class="mdi mdi-chevron-double-right"></i></span>
                            </li>
                        </ul>
                    </nav>
                `;
            };

            #list = (callback = null) => $.ajax({
                url: this.#url,
                type: 'GET',
                success: response => {
                    if(!response.success)return swal({title: response.text,text: "",type: "error"});
                    this.#data = response[this.#name];
                    this.#relations = response.relations ? response.relations : {};
                    this.#showTable();
                    if(callback !== null)
                        callback();
                }
            });

            getData = id => {
                for(let i = 0; i < this.#data.length; i++){
                    if(this.#data[i].id == id) return this.#data[i];
                }
                return null;
            };

        }
        
        $(() => {

            const name = `{{ $pageName }}`;
            const tablename = `{{ $tableName }}`;
            const actions    = JSON.parse(`{!! json_encode($actions) !!}`);
            const listFields = JSON.parse(`{!! json_encode($listFields) !!}`);
            const addFields  = JSON.parse(`{!! isset($actions['add']) && $actions['add'] ? json_encode($addFields) : '[]' !!}`);
            const editFields = JSON.parse(`{!! isset($actions['edit']) && $actions['edit'] ? json_encode($editFields) : '[]' !!}`);
            const fieldDetails = JSON.parse(`{!! json_encode($fieldDetails) !!}`);
            const extraActions = @if(isset($extraActions)) JSON.parse(`{!! json_encode($extraActions) !!}`) @else null @endif;
            const imageFolder = imageUrl + `{!! isset($imageFolder) ? $imageFolder : '' !!}`;
            const url    = `{{ $url }}`;
            const extraFilter = @if(isset($extraFilter)) JSON.parse(`{!! json_encode($extraFilter) !!}`) @else null @endif;

            const $table = new Table(name,tablename,actions,listFields,addFields,editFields,url,fieldDetails,imageFolder,extraActions,extraFilter);

            $(document).on('click','td img',function(e){
                const source = $(this).attr('src');
                const modal = $(document).find('#modal-small');
                modal.find('.modal-title').html('Image');
                modal.find('.modal-body').html(`
                    <img src="${source}" width="100%"/>
                `);
                modal.modal('show');
            });

        });

    </script>

@stop