import React, { useState, useEffect } from "react";
import Header from "../../Components/Header";
import { Container, Label, Form, Input, Button, Select, LabelResult } from './styles'
import axios from "axios";



function Temperature() {

    const [temperatureInput, setTemperatureInput] = useState(0)
    const [fromTemperature, setFromTemperature] = useState('celsius');
    const [toTemperature, setToTemperature] = useState('fahrenheit');
    const [result, setResult] = useState();

    const handleTemperatureInput= (e) => {
        e.persist();
        setTemperatureInput(e.target.value)
    }

    const handleSelectFromTemperature = (e) => {
        e.persist();
        setFromTemperature(e.target.value)
    }

    const handleSelectToTemperature = (e) => {
        e.persist();
        setToTemperature(e.target.value)
    }



    const converterTemperatura = (e) => {
        e.preventDefault()
        const data = {
            submitIn: temperatureInput,
            submitFrom: fromTemperature,
            submitTo: toTemperature,
        }

        axios.post('/api/temperature', data).then(res => {

            setResult(res.data.result)

            console.log(res.data)
            if (res.data.status === 200) {

            } else if (res.data.status === 400) {

                setTemperatureInput({ ...temperatureInput, error_list: res.data.errors });

            }

        });
    }

    return (
        <div>
            <Header />
            <Container>
                <Label>Conversor de Temperatura</Label>
                <Form onSubmit={converterTemperatura}>
                    <Input
                        type="number"
                        onChange={handleTemperatureInput}
                        value={temperatureInput}

                    />
                    <Select onChange={handleSelectFromTemperature} value={fromTemperature}>

                        <option value='celsius'>Celsius</option>
                        <option value='fahrenheit'>Fahrenheit</option>
                        <option value='kelvin'>Kelvin</option>

                    </Select>

                    <Select onChange={handleSelectToTemperature} value={toTemperature}>

                        <option value='celsius'>Celsius</option>
                        <option value='fahrenheit'>Fahrenheit</option>
                        <option value='kelvin'>Kelvin</option>


                    </Select>

                
                
                    <LabelResult>{result}</LabelResult>

                    <Button type="submit">Converter</Button>

                </Form>
            </Container>
        </div>

    )
}

export default Temperature


/*

 <Input
                        disabled={true}
                        value={temperatureInput === "" ? "0" : result === null ? "Converter..." : result}

                    />

                    */

/*

useEffect(() => {
    if(temperatureInput === isNaN) {
        return;
    } else{
        const getTemperatureConvertor = async () => {
            const response = await axios.get(
                `/api/tempereture${convertfrom}`
            );
            console.log("response=>", response);
            //const response = response.date.date;
        };
        getTemperatureConvertor();
    }
}, []);


const handleSwap = (e) => {
    e.preventDefalt();
    setState({
        ...initialState,
        convertfrom: converTo,
        converTo: convertfrom,
        result: null,
    });

};



    <Button onClick={handleSwap}>Inverter</Button>


    <div>
                    <h1 onClick={handleSwap}>
                        &#8595;&#8593;
                    </h1>
                </div>



    const [initialState, setState] = useState({
    temperatureType : ["celsius",  "fahrenheit ", "kelvin"],
    convertfrom: "celsius",
    temperatureInput: "",
    converTo: "fahrenheit",
    result: "",
});

const {temperatureType, convertfrom, temperatureInput, converTo, result} = initialState;

const onChangeInput = (e) =>{
    e.persist();
    setState({
        ...initialState,
        temperatureInput: e.target.value,
        result: null,
    });
    
}; 
const handleSelect = (e) => {
    e.persist();
    setState({
        ...initialState,
        [e.target.name] : e.target.value,
        result: null,
    });
};

const converterTemperatura = (e) => {
    e.preventDefalt();
        const data = {
            in: temperatureInput,
            from: convertfrom,
            to: converTo,

        }
        
        // console.log(data);
        axios.post('/api/temperature', data).then(res => {
            
            setState(res.data.result)
            console.log(res.data)
            
            if (res.data.status === 200) {
    
            } else if (res.data.status === 400) {
    
                setState({ ...temperatureInput, error_list: res.data.errors });
    
            }
    
        });
    }


    return(
    <div>
        <Header/>
        <Container>
            <Label>Conversor de Temperatura</Label>
            <Form onSubmit={converterTemperatura}>
                <Input 
                type="number"
                value={temperatureInput}
                onChange={onChangeInput}
                
                />
                <Select
                    name="convertfrom"
                    value={convertfrom}
                    onChange={handleSelect}
                
                >
                    {temperatureType.map((temperature) => (
                        <option key={temperature} value={temperature}>
                            {temperature}
                        </option>
                    
                    ))}


                </Select>

                <Input 
                disabled={true}
                value={temperatureInput === "" ? "0" : result === null ? "Converter..." : result}
            
                />
                <Select
                    name="converTo"
                    value={converTo}
                    onChange={handleSelect}
                
                >
                    {temperatureType.map((temperature) => (
                        <option key={temperature} value={temperature}>
                            {temperature}
                        </option>
                    
                    ))}


                </Select>
                        
                <LabelResult></LabelResult>
                
                <Button type="submit">Converter</Button>
                
            </Form>
        </Container>
    </div>
        
)
}

*/