import React, { useState } from 'react';
import { useSelector } from 'react-redux';
import SettingsIcon from '@material-ui/icons/Settings';

import LabelIcon from '@material-ui/icons/Label';
import ReceiptIcon from '@material-ui/icons/Receipt';
import AssignmentIcon from '@material-ui/icons/Assignment';
import AccountBalanceWalletIcon from '@material-ui/icons/AccountBalanceWallet';
import BuildIcon from '@material-ui/icons/Build';
import StorageIcon from '@material-ui/icons/Storage';
import LocationCityIcon from '@material-ui/icons/LocationCity';
import BusinessIcon from '@material-ui/icons/Business';
import LocalConvenienceStoreIcon from '@material-ui/icons/LocalConvenienceStore';
import GroupIcon from '@material-ui/icons/Group';
import GroupWorkIcon from '@material-ui/icons/GroupWork';
import PersonPinIcon from '@material-ui/icons/PersonPin';
import AccountBoxIcon from '@material-ui/icons/AccountBox';
import EmojiEventsIcon from '@material-ui/icons/EmojiEvents';
import DateRangeIcon from '@material-ui/icons/DateRange';
import SupervisedUserCircleIcon from '@material-ui/icons/SupervisedUserCircle';
import LocalHospitalIcon from '@material-ui/icons/LocalHospital';
import AssignmentTurnedInIcon from '@material-ui/icons/AssignmentTurnedIn';



import { useMediaQuery, Theme } from '@material-ui/core';
import { useTranslate, DashboardMenuItem, MenuItemLink } from 'react-admin';

//import visitors from '../visitors';
// import orders from '../orders';
// import invoices from '../invoices';
// import products from '../products';
// import categories from '../categories';
// import reviews from '../reviews';
import SubMenu from './SubMenu';




const Menu = ({ onMenuClick, dense, logout }) => {
    const [state, setState] = useState({
        menuTransaction: false,
        menuReport: false,
        menuSetup: false,
        menuUser: false,
        menuMedicalSetup: false
        
    });
    const translate = useTranslate();
    const isXSmall = useMediaQuery((theme) =>
        theme.breakpoints.down('xs')
    );
    const open = useSelector((state) => state.admin.ui.sidebarOpen);
    useSelector((state) => state.theme); // force rerender on theme change

    const handleToggle = (menu) => {
        setState(state => ({ ...state, [menu]: !state[menu] }));
    };

    return (
        <div>
            {' '}
            <DashboardMenuItem onClick={onMenuClick} sidebarIsOpen={open} />
            {/* <SubMenu
                handleToggle={() => handleToggle('menuTransaction')}
                isOpen={state.menuTransaction}
                sidebarIsOpen={open}
                name="Leave Trans"
                icon={<AssignmentIcon/>}
                dense={dense}
            >
                <MenuItemLink
                    to={`/leaves_trans`}
                    primaryText="Trans"
                    leftIcon={<ReceiptIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/leaves_balance`}
                    primaryText="Balance"
                    leftIcon={<AccountBalanceWalletIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/leave_setup`}
                    primaryText="Setup"
                    leftIcon={<BuildIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                
            </SubMenu> */}
            <SubMenu
                handleToggle={() => handleToggle('menuMedical')}
                isOpen={state.menuMedical}
                sidebarIsOpen={open}
                name="Medical"
                icon={<LocalHospitalIcon/>}
                dense={dense}
            >
                <MenuItemLink
                    to={`/medical_checkups`}
                    primaryText="Medical Checkup"
                    leftIcon={<AssignmentTurnedInIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                
                <MenuItemLink
                    to={`/labs_result`}
                    primaryText="Lab Result"
                    leftIcon={<AccountBalanceWalletIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/patients`}
                    primaryText="Patients"
                    leftIcon={<GroupIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                
            </SubMenu>
            <SubMenu
                handleToggle={() => handleToggle('menuMedicalSetup')}
                isOpen={state.menuMedicalSetup}
                sidebarIsOpen={open}
                name="Medical Setup"
                icon={<AssignmentIcon/>}
                dense={dense}
            >
                <MenuItemLink
                    to={`/labs`}
                    primaryText="Lab"
                    leftIcon={<ReceiptIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/labs_setup`}
                    primaryText="Lab Setup"
                    leftIcon={<AccountBalanceWalletIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />

            </SubMenu>
            <SubMenu
                handleToggle={() => handleToggle('menuSetup')}
                isOpen={state.menuSetup}
                sidebarIsOpen={open}
                name="Master"
                icon={<StorageIcon />}
                dense={dense}
            >
                <MenuItemLink
                    to={`/employees`}
                    primaryText="Employees"
                    leftIcon={<GroupIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/companies`}
                    primaryText="Companies"
                    leftIcon={<LocationCityIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/branches`}
                    primaryText="Branches"
                    leftIcon={<BusinessIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/departments`}
                    primaryText="Departments"
                    leftIcon={<LocalConvenienceStoreIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/teams`}
                    primaryText="Teams"
                    leftIcon={<GroupWorkIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/positions`}
                    primaryText="Positions"
                    leftIcon={<PersonPinIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/grades`}
                    primaryText="Grades"
                    leftIcon={<EmojiEventsIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/holidays`}
                    primaryText="Holiday"
                    leftIcon={<DateRangeIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/leave_type`}
                    primaryText="Leave Type"
                    leftIcon={<LabelIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/leave_trans_type`}
                    primaryText="Leave Trans Type"
                    leftIcon={<LabelIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/leave_trans_status`}
                    primaryText="Leave Trans status"
                    leftIcon={<LabelIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
            </SubMenu>
            <SubMenu
                handleToggle={() => handleToggle('menuUser')}
                isOpen={state.menuUser}
                sidebarIsOpen={open}
                name="User Management"
                icon={<SupervisedUserCircleIcon/>}
                dense={dense}
            >
                <MenuItemLink
                    to={`/users`}
                    primaryText="User"
                    leftIcon={<GroupIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/user_roles`}
                    primaryText="User Roles"
                    leftIcon={<LabelIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />

            </SubMenu>
            {/* 
            <SubMenu
                handleToggle={() => handleToggle('menuSetup')}
                isOpen={state.menuCustomers}
                sidebarIsOpen={open}
                name="pos.menu.customers"
                icon={<visitors.icon />}
                dense={dense}
            >
                <MenuItemLink
                    to={`/customers`}
                    primaryText={translate(`resources.customers.name`, {
                        smart_count: 2,
                    })}
                    leftIcon={<visitors.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/segments`}
                    primaryText={translate(`resources.segments.name`, {
                        smart_count: 2,
                    })}
                    leftIcon={<LabelIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
            </SubMenu>
            <SubMenu
                handleToggle={() => handleToggle('menuUser')}
                isOpen={state.menuCustomers}
                sidebarIsOpen={open}
                name="pos.menu.customers"
                icon={<visitors.icon />}
                dense={dense}
            >
                <MenuItemLink
                    to={`/customers`}
                    primaryText={translate(`resources.customers.name`, {
                        smart_count: 2,
                    })}
                    leftIcon={<visitors.icon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
                <MenuItemLink
                    to={`/segments`}
                    primaryText={translate(`resources.segments.name`, {
                        smart_count: 2,
                    })}
                    leftIcon={<LabelIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
            </SubMenu>
            <MenuItemLink
                to={`/reviews`}
                primaryText={translate(`resources.reviews.name`, {
                    smart_count: 2,
                })}
                leftIcon={<reviews.icon />}
                onClick={onMenuClick}
                sidebarIsOpen={open}
                dense={dense}
            /> */}
            {isXSmall && (
                <MenuItemLink
                    to="/configuration"
                    primaryText={translate('pos.configuration')}
                    leftIcon={<SettingsIcon />}
                    onClick={onMenuClick}
                    sidebarIsOpen={open}
                    dense={dense}
                />
            )}
            {isXSmall && logout}
        </div>
    );
};

export default Menu;
