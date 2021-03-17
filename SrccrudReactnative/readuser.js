import React, { Component } from 'react';
import { View, Text, Alert, ScrollView ,SafeAreaView, LogBox  } from 'react-native';
import { FlatList, TextInput} from 'react-native-gesture-handler';

//let getData = [{"flower_name": "Rose", "id": "1"}, {"flower_name": "Lotus", "id": "2"}, {"flower_name": "Jasmine", "id": "3"}]
class readuser extends Component {
  constructor(props) {
    super(props);

    this.state = {
      loading: false,
      data: [],
      page: 1,
      seed: 1,
      error: null,
      refreshing: false,
    };
  }

  componentDidMount() {
    this.makeRemoteRequest();
    // LogBox.ignoreLogs(['VirtualizedLists should never be nested']);
  }

  makeRemoteRequest = () => {
    const { page, seed } = this.state;
    // const url = `https://randomuser.me/api/?seed=${seed}&page=${page}&results=20`;
    // const url = `http://192.168.170.200:8031/testweb/reg/api/flowerslist.php`;
    const url = `http://192.168.170.200:8031/testweb/reg/api/viewuser.php`;
    this.setState({ loading: true });
    fetch(url)
      .then(res => res.json())
      .then(res => {
        this.setState({
          data: res,
          error: res.error || null,
          loading: false,
          refreshing: false
        });
        // console.log("ResArray : ", this.state.data);
      })
      .catch(error => {
        this.setState({ error, loading: false });
      });
  };


  renderitems=(item) =>{
    // console.log("qee  ",item.ID);
    return(
      <View  style={{width:"100%",padding: 5, flexDirection:'row'}}>
        <Text> {item.Ucode}</Text>
        <Text> {item.Ufirstname}</Text>   
        <Text> {item.Ulastname }</Text>                
      </View>
    )
  }

  render() {
 const{data}= this.state;
//  console.log("In Render", data);
    return (
      <View style={{  width:'100%',height:'100%', alignItems: "center", justifyContent: "center" }}>
        {/* <ScrollView showsVerticalScrollIndicator={false}> */}
        {/* <SafeAreaView style={{flex: 1}}> */}
        <Text>Read Data</Text>
        {/* {console.log("In Flist", data)} */}
        <FlatList
        data={data}
        renderItem={({ item }) => (this.renderitems(item) )}
        keyExtractor={item => item.ID}
        />
      {/* </ScrollView> */}
      {/* </SafeAreaView> */}
      </View>
    );
  }
}

export default readuser;
