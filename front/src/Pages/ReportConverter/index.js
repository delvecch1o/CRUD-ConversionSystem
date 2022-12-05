import React, { useState, useEffect } from "react";
import Header from '../../Components/Header/index';
import axios from "axios";
import { Table, Container, Label, Thead, Tr, Th, Tbody, Td, TdIcone } from "./styles";
import { FaTrash } from "react-icons/fa";

function Report() {

    const [reportCoins, setReportCoins] = useState([]);
    const [reportTemperatures, setReportTemperatures] = useState([]);

    const getRegistrosCoins = () => {
        axios.get('/api/coin/show')
            .then(response => {
                setReportCoins(response.data.historicCoin.historicCoin);
                console.log(response.data.historicCoin.historicCoin);

            });

    }

    const getRegistrosTemperature = () => {
        axios.get('/api/temperature/show')
            .then(response => {
                setReportTemperatures(response.data.historicTemperature.historicTemperature);
                console.log(response.data.historicTemperature.historicTemperature);

            });

    }

    useEffect(() => {
        getRegistrosCoins();
        getRegistrosTemperature();
    }, []);

    async function handleDeleteCoin(id) {
        if (window.confirm("Deseja realmente excluir essa conversão ? ")) {
            await axios.delete('/api/coin/' + id)
                .then(response => {
                    alert("Suceeso \n" + response.data.apagou);

                })
                .catch((error) => {
                    alert("ERRO");

                });

        }


    }

    async function handleDeleteTemperature(id) {
        if (window.confirm("Deseja realmente excluir essa conversão ? ")) {
            await axios.delete('/api/temperature/' + id)
                .then(response => {
                    console.log(response.data);
                    alert("Suceeso \n" + response.data.message);

                })
                .catch((error) => {
                    alert("ERRO");

                });

        }


    }




    return (
        <>
            <Header />
            <Container>
                <Label>
                    Lista De converções De Moedas
                </Label>
                <Table>
                    <Thead>
                        <Tr>
                            <Th>ID</Th>
                            <Th>Valor R$</Th>
                            <Th>De</Th>
                            <Th>Para</Th>
                            <Th>Valor Convertido</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {reportCoins.map((conversao, i) => (
                            <Tr key={i}>
                                <Td>{conversao.user_id}</Td>
                                <Td>{conversao.in}</Td>
                                <Td>{conversao.from}</Td>
                                <Td>{conversao.to}</Td>
                                <Td>{conversao.result}</Td>

                                <TdIcone alignCenter width="5%">
                                    <FaTrash onClick={() => handleDeleteCoin(conversao.id)} />
                                </TdIcone>

                            </Tr>
                        ))}
                    </Tbody>
                </Table>

            </Container>


            <Container>
                <Label>
                    Lista De converções Temperaturas
                </Label>
                <Table>
                    <Thead>
                        <Tr>
                            <Th>ID</Th>
                            <Th>Valor R$</Th>
                            <Th>De</Th>
                            <Th>Para</Th>
                            <Th>Valor Convertido</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {reportTemperatures.map((conversao, j) => (
                            <Tr key={j}>
                                <Td>{conversao.user_id}</Td>
                                <Td>{conversao.in}</Td>
                                <Td>{conversao.from}</Td>
                                <Td>{conversao.to}</Td>
                                <Td>{conversao.result}</Td>

                                <TdIcone alignCenter width="5%">
                                    <FaTrash onClick={() => handleDeleteTemperature(conversao.id)} />
                                </TdIcone>

                            </Tr>
                        ))}
                    </Tbody>
                </Table>

            </Container>


        </>


    )
}

export default Report