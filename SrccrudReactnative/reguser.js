import React, { Component } from 'react';
import { View, Text, Button, StyleSheet, TouchableOpacity, PixelRatio } from 'react-native';

import { TextInput, ScrollView } from 'react-native-gesture-handler';
import Readuser from './readuser';
 
class reguser extends Component {
  constructor(props) {
    super(props);
    this.state = {
      Ucode: '',
      Ufirstname: '',
      Ulastname: '',
    };
  }

  InsertRecord = () => {
    try {
      var Ucode = this.state.Ucode;
      var Ufirstname = this.state.Ufirstname;
      var Ulastname = this.state.Ulastname;

      if (Ucode.length == 0 || Ufirstname.length == 0 || Ulastname.length == 0) {
        alert("Required Field is missing");
      }
      else {
        let InsertAPIURL = "http://192.168.170.200:8031/testweb/reg/api/insertuser.php";                  //Fetch API code come here

        var headers = {
          'Accept': 'application/json',
          'Content-Type': 'application.json'
        };

        let Data = {
          Ucode: Ucode,
          Ufirstname: Ufirstname,
          Ulastname: Ulastname
        };                            //console.log("form data  ", Data);

        fetch(InsertAPIURL,
          {
            method: 'POST',
            headers: headers,
            body: JSON.stringify(Data)
          }
        )
          .then((response) => response.json())
          .then((response) => {
            alert(response[0].Message);
          })

          .catch((error) => {
            alert("Error in catch" + error);
          })
      }
    } catch (error) {
      console.log("cat error in insert " + error);
    }
  }

  render() {
  
    return (
      <View style={styles.ViewStyle}>

          <Text style={{ textAlign: "center", fontSize: 25 }}> Register </Text>
          <TextInput
            placeholder={"User Code"}
            placeholderTextColor={"#acacac"}
            keyboardType={"numeric"}
            style={styles.txtStyle}
            onChangeText={Ucode => this.setState({ Ucode })} />

          <TextInput
            placeholder={"First Name"}
            placeholderTextColor={"#acacac"}
            style={styles.txtStyle}
            onChangeText={Ufirstname => this.setState({ Ufirstname })}
          />

          <TextInput
            placeholder={"Last Name"}
            placeholderTextColor={"#acacac"}
            style={styles.txtStyle}
            onChangeText={Ulastname => this.setState({ Ulastname })}
          />

          <TouchableOpacity onPress={() => this.InsertRecord()}>
            <Text style={{ fontSize: 13, textAlign: "center", alignItems: "center", padding: 15, backgroundColor: "blue", color: "#fff", }}> Save Record</Text>
          </TouchableOpacity>
          {/* <Button
          title={"Save Record"} 
          onPress={()=>this.InsertRecord()}/> */}
        <View>
            <Readuser />
        </View>
      </View>

    );
  }
}

export default reguser;

const styles = StyleSheet.create({
  ViewStyle:
  {
    padding: 20,
    marginTop: 10,
    width:'100%'
  },
  txtStyle: {
    borderBottomWidth: 1,
    borderBottomColor: '#acacac',
    marginBottom: 10,
    fontSize: 15,
    zIndex:-1
  },
  container: {
      flex: 1,
      flexDirection: "row",
      // backgroundColor: "red"
  }
  },
);
 