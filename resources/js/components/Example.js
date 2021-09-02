import React , {useState , useEffect} from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";
function Example() {
    const [all_users , setAllUsers] = useState([]);
    const [selected_user , setSelectedUser] = useState([]);
    const [all_messages , setAllMessages] = useState([]);
    useEffect(() =>{
        axios({
            url:'http://127.0.0.1:8000/message',
            method:'GET'
        }).then(res => {
            console.log(res);
            setAllUsers(res?.data?.data);
        })
    } , []);
    useEffect(() => {
        if (selected_user?.id > 0){
            axios({
                url:'http://127.0.0.1:8000/message/'+selected_user?.id,
                method:'GET'
            }).then(res => {
                setAllMessages(res?.data?.data);
            })
        }
    } , [selected_user])

    const select_user = (element) => {
        setSelectedUser(element);
    }
    return (
                <div className="col-md-12" >
                    <div className="card">
                        <div className="card-header"> Component</div>

                        <div className="card-body" style={{height:'70vh'}}>
                            <div className="row">
                                <div className="col-md-4  shadow" style={{height:'65vh'}}>
                                    {
                                        all_users?.length > 0 &&
                                            all_users?.map((element , index) => {
                                                return (
                                                    <div onClick={()=>select_user(element)} className={selected_user?.id == element?.id ? 'clicked-shadow p-2 mt-1 mb-1':'hover-shadow p-2 mt-1 mb-1 border'}  style={{borderRadius:'20px',height:'50px'}} key={index} >{element?.name}</div>
                                                )
                                            })
                                    }
                                </div>
                                <div className="col-md-8 ">
                                    7
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
