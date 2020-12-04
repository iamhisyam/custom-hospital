// in src/Foo.js
import React from 'react';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import { Title } from 'react-admin';

const LabTest = () => (
    <Card>
        <Title title="Leave Trans" />
        <CardContent>
           Hello
        </CardContent>
    </Card>
);

export default LabTest;