import React from 'react';
import Card from '@material-ui/core/Card';
import LibraryBooksIcon from '@material-ui/icons/LibraryBooks';
import { makeStyles } from '@material-ui/core/styles';
import Typography from '@material-ui/core/Typography';
import { useTranslate } from 'react-admin';

import CardIcon from '../commons/CardIcon';

const useStyles = makeStyles({
    main: {
        flex: '1',
        marginRight: '1em',
        marginTop: 20,
    },
    card: {
        overflow: 'inherit',
        textAlign: 'right',
        padding: 16,
        minHeight: 52,
    },
    title: {},
});

const SummaryLeaves = ({ value }) => {
    const translate = useTranslate();
    const classes = useStyles();
    return (
        <div className={classes.main}>
            <CardIcon Icon={LibraryBooksIcon} bgColor="#31708f" />
            <Card className={classes.card}>
                <Typography className={classes.title} color="textSecondary">
                    Total Leaves
                </Typography>
                <Typography variant="h5" component="h2">
                    {value}
                </Typography> 
            </Card>
        </div>
    );
};

export default SummaryLeaves;