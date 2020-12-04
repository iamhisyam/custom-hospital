// in src/Dashboard.js
import React from 'react';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import { Title } from 'react-admin';
import { useMediaQuery, Theme } from '@material-ui/core';

import SummaryLeaves from '../customs/components/dashboard/SummaryLeaves';
import NewEmployees from '../customs/components/dashboard/NewEmployees';
import LatestLeaves from '../customs/components/dashboard/LatestLeaves';
import PendingReviews from '../customs/components/dashboard/PendingReviews';
 

const styles = {
    flex: { display: 'flex' },
    flexColumn: { display: 'flex', flexDirection: 'column' },
    leftCol: { flex: 1, marginRight: '1em' },
    rightCol: { flex: 1, marginLeft: '1em' },
    singleCol: { marginTop: '2em', marginBottom: '2em' },
};


export default () => {
    const isXSmall = useMediaQuery((theme) =>
        theme.breakpoints.down('xs')
    );
    const isSmall = useMediaQuery((theme) =>
        theme.breakpoints.down('sm')
    );
    return isXSmall ? (
        <div>
            <div style={styles.flexColumn}>
                <div style={{ marginBottom: '2em' }}>
                    {/* <Welcome /> */}<p>hello</p>
                </div>
                <div style={styles.flex}>
                    <SummaryLeaves value={120} /> 
                    <LatestLeaves value={10} />
                </div>
                <div style={styles.singleCol}>
                    <PendingReviews value={5} />
                </div>
            </div>
        </div>
    ) : isSmall ? (
        <div style={styles.flexColumn}>
            <div style={styles.singleCol}>
                {/* <Welcome /> */}<p>hello</p>
            </div>
            <div style={styles.flex}>
                <SummaryLeaves value={102} />
            </div>
            <div style={styles.singleCol}>
                <PendingReviews value={5} />
            </div>
        </div>
    ) : (
        <div style={styles.flex}>
            <div style={styles.leftCol}>
                <div style={styles.flex}>
                    <SummaryLeaves value={10} />
                    <PendingReviews value={10} />
                </div>
              
                {/* <div style={styles.singleCol}>
               
                     <LatestLeaves value={10} />
                </div> */}
            </div>
            <div style={styles.rightCol}>
                <div style={styles.flex}>
                    {/* <PendingReviews
                        nb={nbPendingReviews}
                        reviews={pendingReviews}
                        customers={pendingReviewsCustomers}
                    />
                    <NewCustomers /> */}
                     
                     <LatestLeaves value={10} />
                     <NewEmployees value={5} />
                </div>
            </div>
        </div>
    );
};