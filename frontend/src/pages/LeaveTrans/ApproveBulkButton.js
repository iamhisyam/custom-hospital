import React, { Fragment, useState } from 'react';
import {
    Button,
    Confirm,
    useUpdateMany,
    useRefresh,
    useNotify,
    useUnselectAll,
} from 'react-admin';
import CheckIcon from '@material-ui/icons/Check';

const ApproveBulkButton = ({ selectedIds, resource }) => {
    const [open, setOpen] = useState(false);
    const refresh = useRefresh();
    const notify = useNotify();
    const unselectAll = useUnselectAll();
    const [updateMany, { loading }] = useUpdateMany(
        'leaves_trans/approval',
        selectedIds,
        { approval_status_code : 1, is_approved:true },
        {
            onSuccess: () => {
                refresh();
                notify('Leaves updated');
                unselectAll(resource);
            },
            onFailure: error => notify('Error: posts not updated', 'warning'),
        }
    );
    const handleClick = () => setOpen(true);
    const handleDialogClose = () => setOpen(false);

    const handleConfirm = () => {
        updateMany();
        setOpen(false);
    };

    return (
        <Fragment>
            <Button label="Aprove" onClick={handleClick}>
                <CheckIcon />
            </Button>
            <Confirm
                isOpen={open}
                loading={loading}
                title="Approval Leaves"
                content="Are you sure you want to approved for these leaves request?"
                onConfirm={handleConfirm}
                onClose={handleDialogClose}
            />
        </Fragment>
    );
};

export default ApproveBulkButton;