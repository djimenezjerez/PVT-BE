<script>
	export default{
		props:[
			'aid_commitment',
            'affiliate_id',
            'today_date',
		],
        data(){
            return{
                editing: false,
                create: false,
                enable_delete: false,
                show_spinner: false,                
                iterator:-1,
            }
        },        
        computed:{            
        },       
        filters:{
            getFormatDate(date_tarjet){
                return moment(date_tarjet).format("DD/MM/Y");
            },
        },
        methods:{
            toggle_editing:function () {
                this.editing = !this.editing;
                //this.ben = this.original_beneficiar   ies;
                
            },
            get_contributor:function(){
                var contributor_name="";
                if(this.aid_commitment.contributor=='T'){
                    contributor_name="Titular";
                }
                if(this.aid_commitment.contributor=='C'){
                    contributor_name="Cónyuge";
                }                   
                return contributor_name;
            },                            
            toggle_create:function(){
                this.create = !this.create;
            },
            print_aid_commitment(){
                var affiliate_id = this.affiliate_id;                
                printJS({printable:'/quota_aid/'+affiliate_id+'/print/quota_aid_commitment_letter', type:'pdf', showModal:true});
            },
            create_new(){                
                this.aid_commitment.date_commitment=this.today_date;
                this.toggle_editing();                
            },           
            update (value) {
                var id = value;
                let uri = `/aid_commitment/`+id;
                this.show_spinner=true;
                axios.patch(uri,this.aid_commitment)
                    .then(response=>{                     
                        this.editing = false;
                        this.show_spinner=false;                        
                        if(response.data.state =='ALTA'){
                            this.aid_commitment.id  =   response.data.id;    
                            this.aid_commitment.date_commitment = response.data.date_commitment;
                            this.aid_commitment.contributor = response.data.contributor;
                            this.aid_commitment.pension_declaration = response.data.pension_declaration;
                            this.aid_commitment.pension_declaration_date = response.data.pension_declaration_date;
                            this.aid_commitment.state = response.data.state;
                            this.aid_commitment.start_contribution_date = response.start_contribution_date;
                            this.enable_delete=true;                            
                        }
                        else{                            
                            this.create = true;
                            this.enable_delete=false;
                            this.aid_commitment.id = 0;
                            this.aid_commitment.date_commitment = "";
                            this.aid_commitment.contributor = "";
                            this.aid_commitment.pension_declaration = "";
                            this.aid_commitment.pension_declaration_date = '';
                            this.aid_commitment.start_contribution_date = '';
                            this.aid_commitment.state = '';
                        }                        
                        flash('Informacion actualizada');
                        window.location.reload(true);
                       }).catch((error)=>{
                           if(error.response.data.date_commitment !== undefined)
                                flash(error.response.data.date_commitment[0],'error',10000);
                           if(error.response.data.contributor !== undefined)
                                flash(error.response.data.contributor[0],'error',10000);
                           if(error.response.data.pension_declaration !== undefined)
                                flash(error.response.data.pension_declaration[0],'error',10000);
                           if(error.response.data.pension_declaration_date !== undefined)
                                flash(error.response.data.pension_declaration_date[0],'error',10000);
                        this.show_spinner=false;                         
                        var resp = error.response.data;///jQuery.parseJSON(error.response.data);
                        $.each(resp, function(index, value)
                        {                    
                            flash(value,'error',10000);
                        });                         
                       // flash('Error al actualizar el afiliado: '+response.message,'error');
                    })
            }
        }
	}
</script>